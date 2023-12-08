import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CompanydocumentComponent } from './companydocument.component';

describe('CompanydocumentComponent', () => {
  let component: CompanydocumentComponent;
  let fixture: ComponentFixture<CompanydocumentComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CompanydocumentComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CompanydocumentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
