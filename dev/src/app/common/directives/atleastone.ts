import { ValidatorFn, FormGroup, ValidationErrors } from "@angular/forms";

export const atLeastOne = (validator: ValidatorFn, controls?:any) => (
    formgroup: FormGroup,
  ): ValidationErrors | null => {
    if(!controls){
      controls = Object.keys(formgroup.controls)
    }

    const hasAtLeastOne = formgroup && formgroup.controls && controls
      .some(k => !validator(formgroup.controls[k]));

    return hasAtLeastOne ? null : {
      atLeastOne: true,
    };
  };
