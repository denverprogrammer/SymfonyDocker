import LoginRequest from '../models/Request/LoginRequest';
import ObserverSubject, { Observer } from './ObserverSubject';
import LoginResponse from '../models/Response/LoginResponse';
import User from '../models/User';
import ApiService from './ApiService';
import { AxiosResponse } from 'axios';

export type UserObserver = Observer<User>;

class SecuritySubject extends ObserverSubject<User> {
    private apiService = new ApiService();

    constructor() {
        super();

        if (localStorage.getItem('authentication')) {
            const user = {
                firstName: localStorage.getItem('firstName') as string,
                lastName: localStorage.getItem('lastName') as string,
                email: localStorage.getItem('email') as string
            };

            super.setItem(user);
        }
    }

    public setItem(item: User | null): void {
        if (item) {
            localStorage.setItem('firstName', item.firstName);
            localStorage.setItem('lastName', item.lastName);
            localStorage.setItem('email', item.email);
        } else {
            localStorage.removeItem('firstName');
            localStorage.removeItem('lastName');
            localStorage.removeItem('email');
        }

        super.setItem(item);
    }

    public async login(payload: LoginRequest): Promise<AxiosResponse<LoginResponse>> {
        const loginResponse = await this.apiService.login(payload);

        if (loginResponse.status === 200 && loginResponse.data.token) {
            localStorage.setItem('authentication', loginResponse.data.token);
        }

        const profileResponse = await this.apiService.getProfile();

        if (profileResponse.status === 200 && profileResponse.data) {
            this.setItem(profileResponse.data);
        }

        return loginResponse;
    }

    public logout(): void {
        localStorage.removeItem('authentication');
        this.setItem(null);
    }
}

export default SecuritySubject;
