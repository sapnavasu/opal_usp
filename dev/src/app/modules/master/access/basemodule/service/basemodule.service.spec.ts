import { TestBed } from '@angular/core/testing';

import { BasemoduleService } from './basemodule.service';

describe('BasemoduleService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: BasemoduleService = TestBed.get(BasemoduleService);
    expect(service).toBeTruthy();
  });
});
