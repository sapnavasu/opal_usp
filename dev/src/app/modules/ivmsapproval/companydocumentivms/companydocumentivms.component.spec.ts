import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CompanydocumentivmsComponent } from './companydocumentivms.component';

describe('CompanydocumentivmsComponent', () => {
  let component: CompanydocumentivmsComponent;
  let fixture: ComponentFixture<CompanydocumentivmsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CompanydocumentivmsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CompanydocumentivmsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
