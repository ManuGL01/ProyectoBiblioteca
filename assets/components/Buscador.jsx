import React from 'react'

const Buscador = () => {

  const getInfo = async () => {
    try {
        const url = `http://127.0.0.1:8000/api/libros`;
        let respuesta = await fetch(url, {
            headers: {
                'Accept': 'application/json',
            },
        });
        let data = await respuesta.json();
        //console.log(data);
        setLibros(data);
    } catch (error) {
        console.log(error);
    }
};

  return (
    <div>Buscador</div>
  )
}

export default Buscador