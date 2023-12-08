import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IvmsImportViewComponent } from './ivms-import-view.component';

describe('IvmsImportViewComponent', () => {
  let component: IvmsImportViewComponent;
  let fixture: ComponentFixture<IvmsImportViewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IvmsImportViewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IvmsImportViewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
