import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IvmsstaffComponent } from './ivmsstaff.component';

describe('IvmsstaffComponent', () => {
  let component: IvmsstaffComponent;
  let fixture: ComponentFixture<IvmsstaffComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IvmsstaffComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IvmsstaffComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
