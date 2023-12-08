import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SubcriptioncorporateinvestorComponent } from './subcriptioncorporateinvestor.component';

describe('SubcriptioncorporateinvestorComponent', () => {
  let component: SubcriptioncorporateinvestorComponent;
  let fixture: ComponentFixture<SubcriptioncorporateinvestorComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SubcriptioncorporateinvestorComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SubcriptioncorporateinvestorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
