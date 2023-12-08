import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IvmsrenewComponent } from './ivmsrenew.component';

describe('IvmsrenewComponent', () => {
  let component: IvmsrenewComponent;
  let fixture: ComponentFixture<IvmsrenewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IvmsrenewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IvmsrenewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
