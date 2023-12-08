import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ResponseloaderComponent } from './responseloader.component';

describe('ResponseloaderComponent', () => {
  let component: ResponseloaderComponent;
  let fixture: ComponentFixture<ResponseloaderComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ResponseloaderComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ResponseloaderComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
