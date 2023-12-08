import { TestBed } from '@angular/core/testing';

import { StkholderaccessService } from './stkholderaccess.service';

describe('StkholderaccessService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: StkholderaccessService = TestBed.get(StkholderaccessService);
    expect(service).toBeTruthy();
  });
});
