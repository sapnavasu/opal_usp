import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ChangesubscriptionlistComponent } from './changesubscriptionlist.component';

describe('ChangesubscriptionlistComponent', () => {
  let component: ChangesubscriptionlistComponent;
  let fixture: ComponentFixture<ChangesubscriptionlistComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ChangesubscriptionlistComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ChangesubscriptionlistComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
