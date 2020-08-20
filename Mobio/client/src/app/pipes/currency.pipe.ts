import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'currency'
})
export class CurrencyPipe implements PipeTransform {

  transform(value: any, ...args: unknown[]): unknown {
    return "$" + (parseInt(value) / 100).toFixed(2);
  }

}
