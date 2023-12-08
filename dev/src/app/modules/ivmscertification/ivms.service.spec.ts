import { TestBed } from '@angular/core/testing';

import { IvmsService } from './ivms.service';

describe('IvmsService', () => {
  let service: IvmsService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(IvmsService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
