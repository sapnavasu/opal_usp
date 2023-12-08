import { MatPaginatorIntl } from '@angular/material/paginator';
import { Injectable } from "@angular/core";
import { Router } from "@angular/router";
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
@Injectable()
export class CustomMatPaginatorIntl extends MatPaginatorIntl {
  constructor(private router: Router,private remoteService: RemoteService,private cookieService: CookieService) {
    super();
    this.getAndInitTranslations();
  }
  getAndInitTranslations() {
    if(this.router.url == '/profilemanagement/masteraccomplishment' || this.router.url == '/profilemanagement/boardmembers' || this.router.url == '/enterpriseadmin/usermanagement' || this.router.url == '/buyerprofile/buyers'){
      this.itemsPerPageLabel = "Entries/Articles per page";
    }else{
      if(this.cookieService.get('languageCode') == 'ar'){
        this.itemsPerPageLabel = "العناصر لكل صفحة";
      }else{
        this.itemsPerPageLabel = "Items per page";
      }
    } 
    
    
   // this.nextPageLabel = "test";
   // this.previousPageLabel = "test";
   // this.changes.next();
  }
  getRangeLabel = (page: number, pageSize: number, length: number) =>  {
    if (length === 0 || pageSize === 0) {
      return `0 of ${length}`;
    }
    length = Math.max(length, 0);
    const startIndex = page * pageSize;
    const endIndex = startIndex < length ? Math.min(startIndex + pageSize, length) : startIndex + pageSize;
    if(this.cookieService.get('languageCode') == 'ar'){
      return `${startIndex + 1} - ${endIndex} من ${length}`;
    }else{
      return `${startIndex + 1} - ${endIndex} of ${length}`;
    }
  }
}
