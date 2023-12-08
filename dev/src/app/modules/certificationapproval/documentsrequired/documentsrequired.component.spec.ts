import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocumentsrequiredComponent } from './documentsrequired.component';

describe('DocumentsrequiredComponent', () => {
  let component: DocumentsrequiredComponent;
  let fixture: ComponentFixture<DocumentsrequiredComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocumentsrequiredComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocumentsrequiredComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
