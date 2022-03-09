import React from 'react'
import { useNavigate } from 'react-router-dom'

const LibroIndv = () => {

  const navigate = useNavigate();

  const handleVolver = () => {
    navigate('/');
  }

  return (
    <section id="libroIndv">
      HELLO THERE

      <button onClick={handleVolver} className="btn btn-primary">Volver ↩</button>
    </section>
  )
}

export default LibroIndv