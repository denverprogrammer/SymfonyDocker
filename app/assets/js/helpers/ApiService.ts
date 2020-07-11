import axios, { AxiosResponse } from 'axios';
import RegisterRequest from '../models/Request/RegisterRequest';
import LoginRequest from '../models/Request/LoginRequest';
import PasswordRequest from '../models/Request/PasswordRequest';
import LoginResponse from '../models/Response/LoginResponse';
import ApiResponse from '../models/Response/ApiResponse';
import User from '../models/User';

export default class ApiService {
    constructor() {
        const token = localStorage.getItem('authentication');

        if (token) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        }

        axios.defaults.headers.post['Content-Type'] = 'application/json; charset=utf-8';
        axios.defaults.headers.post['Content-Type'] = 'application/json; charset=utf-8';
    }

    public async login(payload: LoginRequest): Promise<AxiosResponse<LoginResponse>> {
        return await axios
            .post(`/api/login_check`, JSON.stringify(payload))
            .then((response: AxiosResponse<LoginResponse>) => {
                return response;
            });
    }

    public async getProfile(): Promise<AxiosResponse<User>> {
        return await axios.get('/api/users/profile').then((response: AxiosResponse<User>) => {
            return response;
        });
    }

    public async register(payload: RegisterRequest): Promise<AxiosResponse<ApiResponse>> {
        return await axios
            .post(`/create_account`, JSON.stringify(payload))
            .then((response: AxiosResponse<ApiResponse>) => {
                return response;
            });
    }

    public async confirmUser(token: string, payload: PasswordRequest): Promise<AxiosResponse> {
        return await axios
            .post(`/confirm_account/${token}`, JSON.stringify(payload))
            .then((response: AxiosResponse) => {
                return response;
            });
    }
}
