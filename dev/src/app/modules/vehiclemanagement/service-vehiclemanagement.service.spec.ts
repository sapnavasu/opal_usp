import { TestBed } from '@angular/core/testing';

import { ServiceVehiclemanagementService } from './service-vehiclemanagement.service';

describe('ServiceVehiclemanagementService', () => {
  let service: ServiceVehiclemanagementService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ServiceVehiclemanagementService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
