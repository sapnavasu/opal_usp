import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IvmsinstallationlistComponent } from './ivmsinstallationlist.component';

describe('IvmsinstallationlistComponent', () => {
  let component: IvmsinstallationlistComponent;
  let fixture: ComponentFixture<IvmsinstallationlistComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IvmsinstallationlistComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IvmsinstallationlistComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
