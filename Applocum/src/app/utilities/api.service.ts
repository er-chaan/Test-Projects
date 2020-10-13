import { Injectable } from '@angular/core';
import { environment } from "../../environments/environment";
import { HttpClient } from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  api:string;

  constructor(private httpClient: HttpClient) {
    this.api= environment.api;
  }
  
  signup(data){
    return this.httpClient.post<any>(this.api+"users/sign_up", data);
  }
  signin(data){
    return this.httpClient.post<any>(this.api+"users/sign_in", data);
  }
}
