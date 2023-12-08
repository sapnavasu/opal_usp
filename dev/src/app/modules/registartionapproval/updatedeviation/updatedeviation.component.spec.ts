import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UpdatedeviationComponent } from './updatedeviation.component';

describe('UpdatedeviationComponent', () => {
  let component: UpdatedeviationComponent;
  let fixture: ComponentFixture<UpdatedeviationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UpdatedeviationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UpdatedeviationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
