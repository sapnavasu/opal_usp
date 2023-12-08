export interface Addpeople {
   name: string;
 }

export interface notes {
   notesid:number;
   allTime:boolean;
   titleinfo:string;
   date: string;
   time?:string;
   title:string;
   external:Addpeople[];
   internal:Addpeople[];
   notifytime:string;
   docs?:any;
   selectedfilesPK?:number[];
   description:string;
   archiveStatus:'Deleted' | 'Archived' | 'Shared' | 'My Notes' | 'Pinned Notes' ;
}