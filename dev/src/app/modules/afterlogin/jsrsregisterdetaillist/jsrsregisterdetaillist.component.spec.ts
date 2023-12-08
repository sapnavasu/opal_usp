import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { JsrsregisterdetaillistComponent } from './jsrsregisterdetaillist.component';

describe('JsrsregisterdetaillistComponent', () => {
  let component: JsrsregisterdetaillistComponent;
  let fixture: ComponentFixture<JsrsregisterdetaillistComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ JsrsregisterdetaillistComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(JsrsregisterdetaillistComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
