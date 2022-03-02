import React, { useState, useEffect } from 'react';

const Main = () => {
    const [libros, setLibros] = useState([]);
    useEffect(() => {
        getInfo();
    }, [])
    const getInfo = async () => {
        try {
            const url = `http://localhost:8000/api/libros`;
            let respuesta = await fetch(url, {
                method: 'GET',
                mode: 'Access-Control-Allow-Origin',
            });
            let data = await respuesta.json();
            setLibros(data);
        } catch {
            console.log(error);
        }
    };
    return (
        <>
            <section class="libros">
                {libros.map((libro) => (
                    <div>
                        <h4>Titulo - {libro.titulo}</h4>
                        <p>Autor - {libro.autor}</p>
                    </div>
                ))}
            </section>
        </>
    )
}

export default Main