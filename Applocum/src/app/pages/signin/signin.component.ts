import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from "@angular/forms";
import { ApiService } from 'src/app/utilities/api.service';
import { Router } from "@angular/router";

@Component({
  selector: 'app-signin',
  templateUrl: './signin.component.html',
  styleUrls: ['./signin.component.css']
})
export class SigninComponent implements OnInit {

  constructor(private formBuilder:FormBuilder, private router:Router, private apiService:ApiService) { }
  signinForm:FormGroup;

  ngOnInit(): void {
    this.signinForm = this.formBuilder.group({
      user : this.formBuilder.group({
        email:["",[Validators.required,Validators.email]],
        password:["",[Validators.required]],
        role:["",[Validators.required]],
      }),
      device_detail: this.formBuilder.group({
        device_type:["",[Validators.required]],
        player_id:["",[Validators.required]],
      }),
    });
    this.signinForm.reset();
  }
  get f() { return this.signinForm.controls; }
  isSigninFormInValid:boolean=false;
  isSigninFormInValidMsg:string;
  loading:boolean=false;
  signin(){
    this.isSigninFormInValid = false;
    this.isSigninFormInValidMsg = "";
    if(this.signinForm.invalid){
      this.isSigninFormInValid = true;
      this.isSigninFormInValidMsg = "Invalid form entry";
      return;
    }
    if(this.signinForm.valid){
      this.loading = true;
      this.apiService.signin(this.signinForm.value).subscribe(response => {
        if(response.success){
          sessionStorage.clear();
          sessionStorage.setItem('user',response.data);
          this.router.navigate(['/dashboard']);
        }else{
          this.isSigninFormInValid = true;
          this.isSigninFormInValidMsg = response.message;
        }
        this.loading = false;
      }, error=>{});
    }
    this.signinForm.reset();
  }

}
