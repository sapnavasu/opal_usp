<?php 
namespace BookStack\Http\Controllers;

use Activity;
use BookStack\Entities\Models\Bookshelf;
use BookStack\Entities\Models\Book;
use BookStack\Entities\Tools\PermissionsUpdater;
use BookStack\Entities\Tools\ShelfContext;
use BookStack\Entities\Repos\BookshelfRepo;
use BookStack\Entities\Repos\BookRepo;
use BookStack\Exceptions\ImageUploadException;
use BookStack\Exceptions\NotFoundException;
use BookStack\Uploads\ImageRepo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Views;
use Illuminate\Support\Facades\DB;


class BookshelfpublicController extends Controller
{

    protected $bookshelfRepo;
      protected $bookRepo;
    protected $entityContextManager;
    protected $imageRepo;

    public function __construct(BookshelfRepo $bookshelfRepo, ShelfContext $entityContextManager, ImageRepo $imageRepo,BookRepo $bookRepo)
    {
        $this->bookshelfRepo = $bookshelfRepo;
        $this->bookRepo = $bookRepo;
        $this->entityContextManager = $entityContextManager;
        $this->imageRepo = $imageRepo;
    }

    /**
     * Display a listing of the book.
     */
    public function index()
    {
        
        $view = setting()->getForCurrentUser('bookshelves_view_type', config('app.views.bookshelves', 'grid'));
           $view = setting()->getForCurrentUser('books_view_type', config('app.views.books'));
        $sort = setting()->getForCurrentUser('bookshelves_sort', 'name');
        $order = setting()->getForCurrentUser('bookshelves_sort_order', 'asc');
       
        
        $sortOptions = [
            'name' => trans('common.sort_name'),
            'created_at' => trans('common.sort_created_at'),
            'updated_at' => trans('common.sort_updated_at'),
        ];

        $shelves = $this->bookshelfRepo->getAllPaginated(18, $sort, $order);
         $books = $this->bookRepo->getAllPaginated(18, $sort, $order);
            $chapter = $this->chapterRepo->getBySlug($bookSlug, $chapterSlug);
        $this->checkOwnablePermission('chapter-view', $chapter);
         $sidebarTree = (new BookContents($chapter->book))->getTree();
        $pages = $chapter->getVisiblePages();
        Views::add($chapter);
        $recents = $this->isSignedIn() ? $this->bookshelfRepo->getRecentlyViewed(4) : false;
        $popular = $this->bookshelfRepo->getPopular(4);
        $new = $this->bookshelfRepo->getRecentlyCreated(4);

        $this->entityContextManager->clearShelfContext();
        $this->setPageTitle(trans('entities.shelves'));
         $this->setPageTitle(trans('entities.books'));
          $this->setPageTitle($chapter->getShortName());
          
        return view('shelves.indexpublic', [
            'shelves' => $shelves,
            'books' => $books,
            'book' => $chapter->book,
            'chapter' => $chapter,
            'recents' => $recents,
            'popular' => $popular,
            'new' => $new,
            'view' => $view,
            'sort' => $sort,
            'order' => $order,
            'sortOptions' => $sortOptions,
        ]);
    }

    /**
     * Show the form for creating a new bookshelf.
     */
    public function create()
    {
        $this->checkPermission('bookshelf-create-all');
        $books = Book::hasPermission('update')->get();
        $this->setPageTitle(trans('entities.shelves_create'));
        return view('shelves.create', ['books' => $books]);
    }

    /**
     * Store a newly created bookshelf in storage.
     * @throws ValidationException
     * @throws ImageUploadException
     */
    public function store(Request $request)
    {
        $this->checkPermission('bookshelf-create-all');
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'string|max:5000',
            'image' => 'nullable|' . $this->getImageValidationRules(),
        ]);

        $bookIds = explode(',', $request->get('books', ''));
        $shelf = $this->bookshelfRepo->create($request->all(), $bookIds);
        $this->bookshelfRepo->updateCoverImage($shelf, $request->file('image', null));

        return redirect($shelf->getUrl());
    }

    /**
     * Display the bookshelf of the given slug.
     * @throws NotFoundException
     */
    public function show(string $slug)
    {
        $shelf = $this->bookshelfRepo->getBySlug($slug);
        
        $this->checkOwnablePermission('book-view', $shelf);

        Views::add($shelf);
        $this->entityContextManager->setShelfContext($shelf->id);
        $view = setting()->getForCurrentUser('bookshelf_view_type', config('app.views.books'));
//echo '<pre>';print_r($shelf);exit;
        $this->setPageTitle($shelf->getShortName());
        return view('shelves.show', [
            'shelf' => $shelf,
            'view' => $view,
            'activity' => Activity::entityActivity($shelf, 20, 1)
        ]);
    }

    /**
     * Show the form for editing the specified bookshelf.
     */
    public function edit(string $slug)
    {
        $shelf = $this->bookshelfRepo->getBySlug($slug);
        $this->checkOwnablePermission('bookshelf-update', $shelf);

        $shelfBookIds = $shelf->books()->get(['id'])->pluck('id');
        $books = Book::hasPermission('update')->whereNotIn('id', $shelfBookIds)->get();

        $this->setPageTitle(trans('entities.shelves_edit_named', ['name' => $shelf->getShortName()]));
        return view('shelves.edit', [
            'shelf' => $shelf,
            'books' => $books,
        ]);
    }

    /**
     * Update the specified bookshelf in storage.
     * @throws ValidationException
     * @throws ImageUploadException
     * @throws NotFoundException
     */
    public function update(Request $request, string $slug)
    {
        $shelf = $this->bookshelfRepo->getBySlug($slug);
        $this->checkOwnablePermission('bookshelf-update', $shelf);
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'string|max:5000',
            'column_level' => 'required',
             'classification' => 'required',
            'image' => 'nullable|' . $this->getImageValidationRules(),
        ]);


        $bookIds = explode(',', $request->get('books', ''));
        $shelf = $this->bookshelfRepo->update($shelf, $request->all(), $bookIds);
        $resetCover = $request->has('image_reset');
        $this->bookshelfRepo->updateCoverImage($shelf, $request->file('image', null), $resetCover);

        return redirect($shelf->getUrl());
    }

    /**
     * Shows the page to confirm deletion
     */
    public function showDelete(string $slug)
    {
        $shelf = $this->bookshelfRepo->getBySlug($slug);
        $this->checkOwnablePermission('bookshelf-delete', $shelf);

        $this->setPageTitle(trans('entities.shelves_delete_named', ['name' => $shelf->getShortName()]));
        return view('shelves.delete', ['shelf' => $shelf]);
    }

    /**
     * Remove the specified bookshelf from storage.
     * @throws Exception
     */
    public function destroy(string $slug)
    {
        $shelf = $this->bookshelfRepo->getBySlug($slug);
        $this->checkOwnablePermission('bookshelf-delete', $shelf);

        $this->bookshelfRepo->destroy($shelf);

        return redirect('/shelves');
    }

    /**
     * Show the permissions view.
     */
    public function showPermissions(string $slug)
    {
        $shelf = $this->bookshelfRepo->getBySlug($slug);
        $this->checkOwnablePermission('restrictions-manage', $shelf);

        return view('shelves.permissions', [
            'shelf' => $shelf,
        ]);
    }
   /**
     * Set the permissions for this bookshelf.
     */
    public function permissions(Request $request, PermissionsUpdater $permissionsUpdater, string $slug)
    {
        $shelf = $this->bookshelfRepo->getBySlug($slug);
        $this->checkOwnablePermission('restrictions-manage', $shelf);

        $permissionsUpdater->updateFromPermissionsForm($shelf, $request);

        $this->showSuccessNotification(trans('entities.shelves_permissions_updated'));
        return redirect($shelf->getUrl());
    }

    /**
     * Copy the permissions of a bookshelf to the child books.
     */
    public function copyPermissions(string $slug)
    {
        $shelf = $this->bookshelfRepo->getBySlug($slug);
        $this->checkOwnablePermission('restrictions-manage', $shelf);

        $updateCount = $this->bookshelfRepo->copyDownPermissions($shelf);
        $this->showSuccessNotification(trans('entities.shelves_copy_permission_success', ['count' => $updateCount]));
        return redirect($shelf->getUrl());
    }
    
    public function showdata(string $target=null)
    {
//     $data = DB::table('bookshelves_books')
//             ->select('book_id')
//             ->wherein('bookshelf_id',[2,3])
//             ->get();
//     echo"<pre>";
//     print_r($data);
//      
      $bookshelves= DB::table('bookshelves')
             ->select('bookshelves.id','bookshelves.name','bookshelves.description','bookshelves.column_level','bookshelves.classification')
              ->where('deleted_at','=',NULL)
              ->orderBy('bookshelves.name','asc')
             ->get();
      
      
      
      $masterData=[];
      
      foreach($bookshelves as $shelve ){
          
          $masterData['shelves'][$shelve->id]['name']=$shelve->name;
          $masterData['shelves'][$shelve->id]['description']=$shelve->description;
          $masterData['shelves'][$shelve->id]['column_level']=$shelve->column_level;
          $masterData['shelves'][$shelve->id]['classification']=$shelve->classification;
           
          $books=DB::table('books')
            ->select('books.id','books.name','books.description','bookshelves_books.bookshelf_id')
            ->where('bookshelves_books.bookshelf_id', '=', $shelve->id)
                  ->where('deleted_at','=',NULL)
            ->leftJoin('bookshelves_books','bookshelves_books.book_id','=','books.id')
                
            ->get();
          
            foreach($books as $book){
              $masterData['shelves'][$book->bookshelf_id]['books'][$book->id]['name']=$book->name;
              $masterData['shelves'][$book->bookshelf_id]['books'][$book->id]['description']=$book->description;
              $masterData['shelves'][$book->bookshelf_id]['books'][$book->id]['specid']=$book->id;
              $masterData['shelves'][$shelve->id]['column_level']=$shelve->column_level;
              $masterData['shelves'][$shelve->id]['classification']=$shelve->classification;
            
            if($shelve->column_level == 2){
                $chapters=DB::table('chapters')
                        ->select('chapters.id','chapters.name','chapters.description','chapters.book_id')
                        ->where('chapters.book_id', '=', $book->id)
                        ->where('deleted_at','=',NULL)
                        ->leftJoin('bookshelves_books','bookshelves_books.book_id','=','chapters.id')
                   ->get();
         
         
                    foreach($chapters as $chapter){
                      $masterData['shelves'][$book->bookshelf_id]['books'][$book->id]['chapters'][$chapter->id]['name']=$chapter->name;
                      $masterData['shelves'][$book->bookshelf_id]['books'][$book->id]['chapters'][$chapter->id]['description']=$chapter->description;
                      $masterData['shelves'][$book->bookshelf_id]['books'][$book->id]['chapters'][$chapter->id]['chapid']=$chapter->id;

                       $pages=DB::table('pages')
                        ->select('pages.id','pages.name','pages.html','pages.chapter_id')
                               ->where('deleted_at','=',NULL)    
                        ->where('pages.chapter_id', '=', $chapter->id)
        //                 ->leftJoin('chapters.id','chapter_id.pages.id','=','pages.id')
                        ->get();


                            foreach($pages as $page){
                      $masterData['shelves'][$book->bookshelf_id]['books'][$book->id]['chapters'][$chapter->id]['pages'][$page->id]['name']=$page->name;
                      $masterData['shelves'][$book->bookshelf_id]['books'][$book->id]['chapters'][$chapter->id]['pages'][$page->id]['html']=$page->html;

                            }

                    }
                }elseif($shelve->column_level == 1){
                    $pages=DB::table('pages')
                        ->select('pages.id','pages.name','pages.html','pages.chapter_id')
                               ->where('deleted_at','=',NULL)    
                        ->where('pages.book_id', '=', $book->id)
        //                 ->leftJoin('chapters.id','chapter_id.pages.id','=','pages.id')
                        ->get();


                    foreach($pages as $page){
                      $masterData['shelves'][$book->bookshelf_id]['books'][$book->id]['pages'][$page->id]['name']=$page->name;
                      $masterData['shelves'][$book->bookshelf_id]['books'][$book->id]['pages'][$page->id]['html']=$page->html;
                    }
                
                }  
                
            }
                
            
      }
      
  
                if(isset($_REQUEST['target'])){

                    $target=$_REQUEST['target'];
                }
                $copyLink=url('/shelves/public/?target=');

//                echo '<pre>';print_r($masterData);exit;       
                
                      return view('shelves.public', [
                            'masterData' => $masterData,
                            'target'=>$target,
                            'copyLink'=>$copyLink

                        ]);
                      } 
                      
      
public function hiddendata(string $target=null){
   
      $bookshelves= DB::table('bookshelves')
             ->select('bookshelves.id','bookshelves.name','bookshelves.description','bookshelves.column_level','bookshelves.classification')
              ->where('deleted_at','=',NULL)
              ->orderBy('bookshelves.name','asc')
             ->get();
      
      
      
      $masterDataPrivate=[];
      
      foreach($bookshelves as $shelve ){
          
          $masterDataPrivate['shelves'][$shelve->id]['name']=$shelve->name;
          $masterDataPrivate['shelves'][$shelve->id]['description']=$shelve->description;
          $masterDataPrivate['shelves'][$shelve->id]['column_level']=$shelve->column_level;
          $masterDataPrivate['shelves'][$shelve->id]['classification']=$shelve->classification;
            
          $books=DB::table('books')
            ->select('books.id','books.name','books.description','bookshelves_books.bookshelf_id')
            ->where('bookshelves_books.bookshelf_id', '=', $shelve->id)
                  ->where('deleted_at','=',NULL)
            ->leftJoin('bookshelves_books','bookshelves_books.book_id','=','books.id')
                
            ->get();
          
            foreach($books as $book){
              $masterDataPrivate['shelves'][$book->bookshelf_id]['books'][$book->id]['name']=$book->name;
              $masterDataPrivate['shelves'][$book->bookshelf_id]['books'][$book->id]['description']=$book->description;
              $masterDataPrivate['shelves'][$book->bookshelf_id]['books'][$book->id]['specid']=$book->id;
              $masterDataPrivate['shelves'][$shelve->id]['column_level']=$shelve->column_level;
              
            if($shelve->column_level == 2){
                $chapters=DB::table('chapters')
                        ->select('chapters.id','chapters.name','chapters.description','chapters.book_id')
                        ->where('chapters.book_id', '=', $book->id)
                        ->where('deleted_at','=',NULL)
                        ->leftJoin('bookshelves_books','bookshelves_books.book_id','=','chapters.id')
                   ->get();
         
         
                    foreach($chapters as $chapter){
                      $masterDataPrivate['shelves'][$book->bookshelf_id]['books'][$book->id]['chapters'][$chapter->id]['name']=$chapter->name;
                      $masterDataPrivate['shelves'][$book->bookshelf_id]['books'][$book->id]['chapters'][$chapter->id]['description']=$chapter->description;
                      $masterDataPrivate['shelves'][$book->bookshelf_id]['books'][$book->id]['chapters'][$chapter->id]['chapid']=$chapter->id;

                       $pages=DB::table('pages')
                        ->select('pages.id','pages.name','pages.html','pages.chapter_id')
                               ->where('deleted_at','=',NULL)    
                        ->where('pages.chapter_id', '=', $chapter->id)
        //                 ->leftJoin('chapters.id','chapter_id.pages.id','=','pages.id')
                        ->get();


                            foreach($pages as $page){
                      $masterDataPrivate['shelves'][$book->bookshelf_id]['books'][$book->id]['chapters'][$chapter->id]['pages'][$page->id]['name']=$page->name;
                      $masterDataPrivate['shelves'][$book->bookshelf_id]['books'][$book->id]['chapters'][$chapter->id]['pages'][$page->id]['html']=$page->html;

                            }

                    }
                }elseif($shelve->column_level == 1){
                    $pages=DB::table('pages')
                        ->select('pages.id','pages.name','pages.html','pages.chapter_id')
                               ->where('deleted_at','=',NULL)    
                        ->where('pages.book_id', '=', $book->id)
        //                 ->leftJoin('chapters.id','chapter_id.pages.id','=','pages.id')
                        ->get();


                    foreach($pages as $page){
                      $masterDataPrivate['shelves'][$book->bookshelf_id]['books'][$book->id]['pages'][$page->id]['name']=$page->name;
                      $masterDataPrivate['shelves'][$book->bookshelf_id]['books'][$book->id]['pages'][$page->id]['html']=$page->html;
                    }
                
                }
            }
      }
      
if(isset($_REQUEST['target'])){

    $target=$_REQUEST['target'];
}
$copyLink=url('/shelves/private/?target=');

//        echo'<pre>';print_r($masterDataPrivate);exit;

      return view('shelves.private', [
            'masterDataPrivate' => $masterDataPrivate,
            'target'=>$target,
            'copyLink'=>$copyLink
          
        ]);
      } 
      
     
          
      
  }
  
