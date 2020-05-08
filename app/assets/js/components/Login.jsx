import React, {Component} from 'react';
import axios from 'axios';
    
class Login extends Component {
    constructor() {
        super();
        this.state = {
            username: null,
            password: null
        };
    }
    
    submitForm() {
        axios.post(`/api/login_check.json`, [])
            .then(users => {});
    }

    render() {
        return(
            <div>
                <form>
                    <div className="form-group">
                        <label htmlFor="email">Email address</label>
                        <input type="email" className="form-control" id="email" value={this.state.username} />
                        <small id="emailHelp" className="form-text text-muted">
                            We'll never share your email with anyone else.
                        </small>
                    </div>
                    <div className="form-group">
                        <label htmlFor="password">Password</label>
                        <input type="password" className="form-control" id="password" value={this.state.password}/>
                    </div>
                    <button type="submit" className="btn btn-primary">Submit</button>
                </form>
            </div>
        )
    }
}

export default Login;
