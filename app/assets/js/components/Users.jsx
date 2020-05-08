import React, {Component} from 'react';
import axios from 'axios';
    
class Users extends Component {
    constructor() {
        super();
        this.state = { users: [], loading: true};
    }
    
    componentDidMount() {
        axios.get(`/api/users.json`).then(users => {
            this.setState({ users: users.data, loading: false})
        });
    }

    render() {
        const loading = this.state.loading;
        return(
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center">
                                <span>List of users</span>Created with 
                                <i className="fa fa-heart"></i> by yemiwebby
                            </h2>
                        </div>
                        {loading ? (
                            <div className='row text-center'>
                                <span className="fa fa-spin fa-spinner fa-4x"></span>
                            </div>
                        ) : (
                            <div className='row'>
                                { this.state.users.map(user =>
                                    <div className="col-md-10 offset-md-1 row-block" key={user.id}>
                                        <ul id="sortable">
                                            <li>
                                                <div className="media">
                                                    <div className="media-left align-self-center">
                                                        <img className="rounded-circle" src="#"/>
                                                    </div>
                                                    <div className="media-body">
                                                        <h4>{user.firstName} {user.lastName}</h4>
                                                        <p>{user.username}</p>
                                                    </div>
                                                    <div className="media-right align-self-center">
                                                        <a href="emailto:{user.email}" className="btn btn-default">Contact</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                </section>
            </div>
        )
    }
}
export default Users;
