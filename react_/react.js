//import React, { Component } from 'react';
const typeAPI = 'http://react/directorywebservicehandler.php?function=get_type';
const directoriesAPI = 'http://react/directorywebservicehandler.php?function=get_directories';
const getConfigs = {method : 'GET',
                    headers : { 'Accept' : 'application/json', 
                                'Content-Type': 'application/json'}
                    }
const DEFAULT_QUERY = 'redux';

class Directory extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            type: [],
            activetype : 'hotel',
            directories: []
        }
        this.handleCheck = this.handleCheck.bind(this)
    }
    componentDidMount() {
        this.getType()
        this.displayDirectory()
    }
    handleCheck(){
        this.setState({activetype:'hotel'})
    }
    getType(){
        fetch(typeAPI,getConfigs)
        .then(response => {return response.json()})
        .then(data => {
            const liclass = ' list-group-item';
            let category = Object.keys(data).map((key)=><a href='#'  key={'link'+key}  onClick={this.updateDirectory.bind(this)}> <li key={key} className={liclass}>{data[key]}</li></a>);
            return this.setState({type: category})
            })
    }
    displayDirectory(){
        fetch(directoriesAPI.concat('&params[type]=',this.state.activetype),getConfigs)
        .then(response => {return response.json()})
        .then(data =>{
          let directories =  Object.keys(data).map((key)=>
            <li className="list-group-item" key={key}>
                <div className="directory-list">
                  <h5  className="directory-header-info">{data[key].name}</h5>
                  <div className="directory-info">
                      <span className="address">
                      <span className="fa fa-map-marker faicons"></span> {data[key].address}</span> <br/>
                      <span className="phone"><span className="fa fa-phone faicons"></span>{data[key].phonenumber}</span>
                  </div>
                </div>
             </li>
            );
            return this.setState({directories: directories });
        })
    }
    updateDirectory(e){
        this.setState({activetype : 'school'})
        console.log(e.target.key)
       // this.displayDirectory()
    }
    render(){
        const type = this.state.type
        const directories = this.state.directories
        
        return (
            <div className="row">
            
                <div className="col-2">
                    <ul className="list-group list-group-flush directorycateg" >
                        {type}
                    </ul>
                </div>
                <div className="col-8">
                    <div className="container-fluid directorylist">
                        <ul className="list-group list-group-flush">
                            {directories}
                        </ul>
                    </div>  
                </div>
            </div>

        )
    }
    
}
class Checboox extends React.Component{
    constructor(props){ 
        super(props)
        this.state ={
            checked: false
        }
        this.handleCheck = this.handleCheck.bind(this)
    }
    handleCheck(){
        this.setState({
            checked: !this.state.checked
        })
    }
    render(){
        var msg
        if(this.state.checked){
            msg ='checked'
        }else{
            msg= 'nope'
        }
        return(
            <div><input type="checkbox" onChange={this.handleCheck}/>
            <p>This box {msg} </p>
            </div>
        )
    }
}
ReactDOM.render(
    <Directory/>,
    document.getElementById('directory-container')
)
