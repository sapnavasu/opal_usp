import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ChangesubscriptionlistviewComponent } from './changesubscriptionlistview.component';

describe('ChangesubscriptionlistviewComponent', () => {
  let component: ChangesubscriptionlistviewComponent;
  let fixture: ComponentFixture<ChangesubscriptionlistviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ChangesubscriptionlistviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ChangesubscriptionlistviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
