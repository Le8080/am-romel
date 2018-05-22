<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Oswald">
    <title>React-Directory</title>
</head>
<body>
    <div class="container-fluid directory">
        <div class="row">
           <div class="col-md-2">
               <div class="logo-txt">LF</div>
           </div>
            <div class="col-md-8">
                  <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text searchbutton"><li class="fa fa-search"></li></div>
                    </div>
                    <input type="text" class="form-control searchinput" id="inlineFormInputGroupUsername2" placeholder="Search">
                  </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <ul class="list-group list-group-flush directorycateg">
                  <li class="list-group-item">Business</li>
                  <li class="list-group-item">Hotel</li>
                  <li class="list-group-item">School</li>
                  <li class="list-group-item">Restaurant</li>
                </ul>
            </div>
            <div class="col-8">
              <div class="container-fluid directorylist">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                      <div class="directory-list">
                        <h5  class="directory-header-info">Google</h5>
                        <div class="directory-info">
                            <span class="address">
                            <span class="fa fa-map-marker faicons"></span> 10 Commonwealth Road, Pyrmont, Australia</span> <br/>
                            <span class="phone"><span class="fa fa-phone faicons"></span> 02 550 4231</span>
                        </div>
                      </div>
                  </li>
                <li class="list-group-item">
                      <div class="directory-list">
                        <h5  class="directory-header-info">Google</h5>
                        <div class="directory-info">
                            <span class="address">
                            <span class="fa fa-map-marker faicons"></span> 10 Commonwealth Road, Pyrmont, Australia</span> <br/>
                            <span class="phone"><span class="fa fa-phone faicons"></span> 02 550 4231</span>
                        </div>
                      </div>
                  </li>
                 <li class="list-group-item">
                      <div class="directory-list">
                        <h5  class="directory-header-info">Google</h5>
                        <div class="directory-info">
                            <span class="address">
                            <span class="fa fa-map-marker faicons"></span> 10 Commonwealth Road, Pyrmont, Australia</span> <br/>
                            <span class="phone"><span class="fa fa-phone faicons"></span> 02 550 4231</span>
                        </div>
                      </div>
                  </li>
                </ul>
              </div>  
            </div>
        </div> 
    </div>
    <div id="react-container"></div>
    <script type="text/babel">

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
    </script>
    
</body>
</html>