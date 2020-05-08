import React, {Component} from 'react';
import axios from 'axios';

class Register extends Component {
    constructor() {
        super();
        this.state = {
            firstName: '',
            lastName: '',
            email: '',
            password: '',
            confirm: ''
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleChange(event) {
        this.setState({[event.target.id]: event.target.value});
    }

    handleSubmit(event) {
        const payload = {
            firstName: this.state.firstName,
            lastName: this.state.lastName,
            email: this.state.email,
            password: this.state.password
        };
        const $options = {
            headers: {'content-type': 'application/json; charset=utf-8'}
        };

        axios.post(`/auth/register`, JSON.stringify(payload), $options)
        .then(response => { return response.data; });

        event.preventDefault();
    }

    render() {
        return(
            <div className="row">
                <div className="col">
                    <form onSubmit={this.handleSubmit}>
                        <div className="row">
                            <div className="col-sm-6">
                                <div className="form-group">
                                    <label htmlFor="firstName">First Name</label>
                                    <input id="firstName"
                                        type="text"
                                        className="form-control"
                                        value={this.state.firstName}
                                        onChange={this.handleChange}
                                    />
                                </div>
                            </div>
                            <div className="col-sm-6">
                                <div className="form-group">
                                    <label htmlFor="lastname">Last Name</label>
                                    <input id="lastName"
                                        type="text"
                                        className="form-control"
                                        value={this.state.lastName}
                                        onChange={this.handleChange}
                                    />
                                </div>
                            </div>
                        </div>
                        <div className="row">
                            <div className="col-6">
                                <div className="form-group">
                                    <label htmlFor="email">Email</label>
                                    <input id="email"
                                        type="text"
                                        className="form-control"
                                        value={this.state.email}
                                        onChange={this.handleChange}
                                    />
                                </div>
                            </div>
                        </div>
                        <div className="row">
                            <div className="col-sm-6">
                                <div className="form-group">
                                    <label htmlFor="password">Password</label>
                                    <input id="password"
                                        type="password"
                                        className="form-control"
                                        value={this.state.password}
                                        onChange={this.handleChange}
                                    />
                                </div>
                            </div>
                            <div className="col-sm-6">
                                <div className="form-group">
                                    <label htmlFor="confirm">Confirm Password</label>
                                    <input id="confirm"
                                        type="password"
                                        className="form-control"
                                        value={this.state.confirm}
                                        onChange={this.handleChange}
                                    />
                                </div>
                            </div>
                        </div>
                        <button type="submit" className="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        )
    }
}

export default Register;
