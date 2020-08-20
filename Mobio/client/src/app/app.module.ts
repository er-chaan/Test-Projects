import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { ProductComponent } from './product/product/product.component';

import { HttpClientModule } from '@angular/common/http';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { NgxSpinnerModule } from "ngx-spinner";
import { DatePipe } from './pipes/date.pipe';
import { CurrencyPipe } from './pipes/currency.pipe';


@NgModule({
  declarations: [
    AppComponent,
    ProductComponent,
    DatePipe,
    CurrencyPipe
  ],
  imports: [
    NgxSpinnerModule,
    HttpClientModule,
    BrowserModule,
    BrowserAnimationsModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
