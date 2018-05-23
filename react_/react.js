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
    <Checboox/>,
    document.getElementById('react-container')
)