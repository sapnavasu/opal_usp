import { SelectionModel } from "@angular/cdk/collections";

export class MultipleCheckbox {
    
    selection = new SelectionModel<string>(true, []);
    isAllSelected(sourceData: any) {
        if (!sourceData) { return false; }
        if (this.selection.isEmpty()) { return false; }
          return this.selection.selected.length == sourceData.data.length;
      }
    masterToggle(sourceData: any) {
        if (!sourceData) { return; }

        if (this.isAllSelected(sourceData)) {
            this.selection.clear();
        } else {
            sourceData.data.forEach(data => { this.selection.select(data['adminusermst_pk'])})
        }
    }

}