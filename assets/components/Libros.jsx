import React, { useState, useEffect } from 'react';
import Buscador from './Buscador';

const Libros = () => {
    const [libros, setLibros] = useState([]);

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

    useEffect(() => {
        getInfo();
    }, [])
    return (
        <>

            <section className="librosYbuscador">

            <Buscador /> 

                <section className="libros">
                    {libros.map((libro) => (
                        <div className="libro" key={libro.id}>
                            <h4>{libro.titulo}</h4>
                            <p>{libro.autor}</p>
                        </div>
                    ))}
                </section>

            </section>

        </>
    )
}

export default Libros