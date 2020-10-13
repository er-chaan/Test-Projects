import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from "@angular/forms";
import { ApiService } from 'src/app/utilities/api.service';
import { Router } from "@angular/router";

@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.css']
})
export class SignupComponent implements OnInit {

  constructor(private formBuilder:FormBuilder, private router:Router, private apiService:ApiService) { }
  signupForm:FormGroup;

  ngOnInit(): void {
    this.signupForm = this.formBuilder.group({
      user : this.formBuilder.group({
        email:["",[Validators.required,Validators.email]],
        password:["",[Validators.required]],
        first_name:["",[Validators.required]],
        last_name:["",[Validators.required]],
        mobile : ["", [Validators.required, Validators.maxLength(10), Validators.minLength(10), Validators.pattern('^-?[0-9]\\d*(\\.\\d{1,2})?$')]],
        role:["",[Validators.required]],
        gender:["",[Validators.required]],
      }),
      profile: this.formBuilder.group({
        date_of_birth:["",[Validators.required]],
      }),
      device_detail: this.formBuilder.group({
        device_type:["",[Validators.required]],
        player_id:["",[Validators.required]],
      }),
    });
    this.signupForm.reset();
  }
  get f() { return this.signupForm.controls; }
  isSignupFormInValid:boolean=false;
  isSignupFormInValidMsg:string;
  loading:boolean=false;
  signup(){
    this.isSignupFormInValid = false;
    this.isSignupFormInValidMsg = "";
    if(this.signupForm.invalid){
      this.isSignupFormInValid = true;
      return;
    }
    if(this.signupForm.valid){
      this.loading = true;
      this.apiService.signup(this.signupForm.value).subscribe(response => {
        if(response.success){
          sessionStorage.clear();
          sessionStorage.setItem('user',response.data);
          this.router.navigate(['/dashboard']);
        }else{
          this.isSignupFormInValid = true;
          this.isSignupFormInValidMsg = response.message;
        }
        this.loading = false;
      }, error=>{});
    }
    this.signupForm.reset();
  }

}
