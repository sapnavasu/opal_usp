import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IvmsdesktopComponent } from './ivmsdesktop.component';

describe('IvmsdesktopComponent', () => {
  let component: IvmsdesktopComponent;
  let fixture: ComponentFixture<IvmsdesktopComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IvmsdesktopComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IvmsdesktopComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
