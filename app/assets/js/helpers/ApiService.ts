import axios, { AxiosResponse, AxiosRequestConfig } from 'axios';
import RegisterRequest from '../models/Request/RegisterRequest';
import LoginRequest from '../models/Request/LoginRequest';
import LoginResponse from '../models/Response/LoginResponse';
import ApiResponse from '../models/Response/ApiResponse';
import User from '../models/User';

export default class ApiService {
    private jsonOptions = {
        headers: {
            Accept: 'application/json; charset=utf-8',
            'Content-Type': 'application/json; charset=utf-8'
        }
    };

    getHeaders = (): AxiosRequestConfig => {
        const headers = {
            headers: {
                Accept: 'application/json; charset=utf-8',
                'Content-Type': 'application/json; charset=utf-8'
            }
        };

        const token = localStorage.getItem('authentication');

        if (token) {
            headers.headers['Authorization'] = `Bearer ${token}`;
        }

        return headers;
    };

    public async login(payload: LoginRequest): Promise<AxiosResponse<LoginResponse>> {
        return await axios
            .post(`/login_check`, JSON.stringify(payload), this.getHeaders())
            .then((response: AxiosResponse<LoginResponse>) => {
                return response;
            });
    }

    public async getProfile(): Promise<AxiosResponse<User>> {
        return await axios.get(`/auth/profile`, this.getHeaders()).then((response: AxiosResponse<User>) => {
            return response;
        });
    }

    public async register(payload: RegisterRequest): Promise<AxiosResponse<ApiResponse>> {
        return await axios
            .post(`/register`, JSON.stringify(payload), this.getHeaders())
            .then((response: AxiosResponse<ApiResponse>) => {
                return response;
            });
    }
}
