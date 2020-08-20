import { Component, OnInit, HostListener } from '@angular/core';
import { ProductService } from "../../services/product.service";
import { NgxSpinnerService } from "ngx-spinner";

@Component({
  selector: 'app-product',
  templateUrl: 'product.component.html',
  styleUrls: ['product.component.css']
})
export class ProductComponent implements OnInit {

  constructor(private productService:ProductService, private spinner: NgxSpinnerService){}
  
  ngOnInit(): void {
    this.spinner.show();
    this.getProduct(this.page,this.limit);
  }

  products = new Array();
  page:number = 1;
  limit:number = 15;
  sort:string = "size";
  getProduct(page, limit){
    page = this.page;
    limit = this.limit;
    this.productService.getProducts(page,limit,this.sort).subscribe(data => {
      if(data){
        this.products = this.products.concat(data);
        this.spinner.hide();
      }else{
        this.spinner.hide();
        alert("~ end of catalogue ~");
      }
    });
  }
  getSortedProducts(param){
    this.spinner.show();
    this.page = 1;
    this.sort = param;
    this.productService.getSortedProducts(this.page,this.limit,param).subscribe(data => {
      this.products = null;
      this.products = data;
      this.spinner.hide();
    });
  }

  identify(index, p){
    return p.id; 
  }
  
  @HostListener('scroll', ['$event'])
  scrollHandler(event) {
       if (event.target.offsetHeight + event.target.scrollTop >= (event.target.scrollHeight - 250)) {
          this.page++;
          this.getProduct(this.page,this.limit);
      }
  }

}
