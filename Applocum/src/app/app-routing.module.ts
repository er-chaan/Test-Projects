import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { X404Component } from './theme/x404/x404.component';
import { DashboardComponent } from './pages/dashboard/dashboard.component';
import { SigninComponent } from './pages/signin/signin.component';
import { SignupComponent } from './pages/signup/signup.component';
import { LandingComponent } from './theme/landing/landing.component';
import { PublicGuard } from "./utilities/public.guard";
import { AuthGuard } from "./utilities/auth.guard";

const routes: Routes = [
  { path: "", component: LandingComponent, canActivate: [PublicGuard] },
  { path: "signin", component: SigninComponent, canActivate: [PublicGuard] },
  { path: "signup", component: SignupComponent, canActivate: [PublicGuard] },  
  { path: "dashboard", component: DashboardComponent, canActivate: [AuthGuard] },
  { path: "**", component: X404Component }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
