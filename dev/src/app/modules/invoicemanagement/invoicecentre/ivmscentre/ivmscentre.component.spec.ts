import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IvmscentreComponent } from './ivmscentre.component';

describe('IvmscentreComponent', () => {
  let component: IvmscentreComponent;
  let fixture: ComponentFixture<IvmscentreComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IvmscentreComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IvmscentreComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
