import {Resolve,ActivatedRouteSnapshot,ActivatedRoute,RouterStateSnapshot, Router} from '@angular/router';
import { Observable } from 'rxjs';
import {ApprovalService} from './approval.service';
import {ViewModelData} from './viewandvalidate/viewModel/view-model';
import { Injectable } from '@angular/core';

@Injectable()

export class ViewResolverService{
    queryParam;
    constructor(private approvalService:ApprovalService, private router: ActivatedRoute){

    }
}