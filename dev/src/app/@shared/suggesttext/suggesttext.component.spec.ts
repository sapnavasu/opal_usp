import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SuggesttextComponent } from './suggesttext.component';

describe('SuggesttextComponent', () => {
  let component: SuggesttextComponent;
  let fixture: ComponentFixture<SuggesttextComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SuggesttextComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SuggesttextComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
