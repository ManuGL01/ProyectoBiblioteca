import React, { useState, useEffect } from 'react';

const Main = () => {
    const [libros, setLibros] = useState([]);
    useEffect(() => {
        getInfo();
    }, [])
    const getInfo = async () => {
        try {
            const url = `http://127.0.0.1:8000/api/libros`;
            let respuesta = await fetch(url);
            let data = await respuesta.json();
            console.log(data);
            setLibros(data);
        } catch (error) {
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