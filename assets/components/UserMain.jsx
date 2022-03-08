import React, { useState } from 'react'
import Libros from './Libros';
import Login from './Login';

const UserMain = () => {

  const [userGlobal, setUserGlobal] = useState(null);
  
  return (
    <section className="mainIndex">
      {userGlobal ? null : <Login setUserGlobal={setUserGlobal}/>}
      <Libros/>
    </section>
  )
}

export default UserMain