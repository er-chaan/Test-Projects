import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Observable } from "rxjs";
import { environment } from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})

export class ProductService {
  
  api:any;
  constructor(private httpClient: HttpClient) {
    this.api = environment.api;
  }

  getProducts(page:number,limit:number,sort:string): Observable<any>{
    return this.httpClient.get<any>(this.api+"/products?_sort="+sort+"&_page="+page+"&_limit="+limit+"");
  }

  getSortedProducts(page:number,limit:number,param:any): Observable<any>{
    return this.httpClient.get<any>(this.api+"/products?_limit="+limit+"&_sort="+param+"");
  }

}
