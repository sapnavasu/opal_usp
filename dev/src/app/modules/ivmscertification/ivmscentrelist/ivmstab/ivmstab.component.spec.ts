import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IvmstabComponent } from './ivmstab.component';

describe('IvmstabComponent', () => {
  let component: IvmstabComponent;
  let fixture: ComponentFixture<IvmstabComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IvmstabComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IvmstabComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
