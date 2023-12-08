export const InptLang_Var = {
    // for directives
    appAlphanumsymb: /[^a-zA-Z0-9@'!#$%&':*+/=?^_`{|},<>;"\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF\uFB50-\uFDCF\uFDF0-\uFDFF\uFE70-\uFEFF)\\[\](~.-\s+]/g,
    appAlphanumsymb_msg : 'OPAL supports only English  and Arabic as an input in any field.',
    appAlphanumminusmsg : 'It supports only Alphbahets, Numbers and Minus symbol as an input in this field.',
    appAlphanumsymb_reg : new RegExp(/[a-zA-Z0-9@'!#$%&':*+/=?^_`{|},<>;")\\[\](~.-\s+]/g),
    // for pattern
    patt_email: '(https?://)?([\\da-zA-Z.-]+)\\.([a-zA-Z.]{2,6})[/\\w.-]*/?',
   };

export class InptLang_Ctrl {
    // ckeditor directives common function
    public ckeditor_dir(event: any, snackBar: any, model: any) {
      if (model.match(InptLang_Var.appAlphanumsymb)) {
          snackBar.open(InptLang_Var.appAlphanumsymb_msg, null, {
          duration: 5000,
          panelClass: ['warning'],
          horizontalPosition: 'right',
          verticalPosition: 'top'
          });
      }

      return(model.replace(InptLang_Var.appAlphanumsymb, ''));
    }
    public ckeditor_count(input: any) {
      if (input != null) {
        input = input.toString().replace(/<\/?[^>]+(>|$)/g, '');
        input = input.toString().replace('&nbsp;', ' ');
        return input.length;
      } else {
        return 0;
      }
    }
   }
