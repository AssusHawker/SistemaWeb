# Sistema de Bodega Web 

## Easy Mar del Plata (Cencosud)

## Usos


### El sistema permite manejar productos de bodega de venta web 
### Tiene usuarios con distintos privilegios
### El sistema se usa en red interna
Fechado de vida de cada pedido y un semáforo con estados:
```
#de 0 a 6 días => el producto esta en estado VERDE a la espera que lo retiren
```
```
# de 7 a 9 días el producto esta en estado AMARILLO para poder llamar al cliente 
en cada uno de los días y poner el comentario del hecho
```
```
#de mas de 10 días el producto esta en ROJO y es devuelto a la tienda
```

## Proceso
El sistema esta desarrollado de la siguiente manera:
```
 ==> En PHP 7.X Vanilla (Sin ningun Framework)
 ==> Javascript para validaciones de formularios
 ==> Mysql como base de datos (151Mil productos)
 ==> CSS / Bootstrap
 ==> Jquery y algunas librerías de JS

```
## Estado
 ### [estable En producción  (para mejorar muchas cosas)]


## License
[MIT](https://choosealicense.com/licenses/mit/)
