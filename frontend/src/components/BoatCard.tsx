import { Link } from 'react-router-dom';
import type { Boat } from '../types';
import Card from './Card';

interface BoatCardProps {
  boat: Boat;
}

/**
 * BoatCard component - displays boat info in a card
 */
const BoatCard = ({ boat }: BoatCardProps) => {
  const imageUrl = boat.imagen_url || boat.imagen
    ? (boat.imagen_url || `/storage/${boat.imagen}`)
    : null;

  return (
    <Link to={`/boats/${boat.id}`} className="block">
      <Card className="hover:shadow-md transition-shadow cursor-pointer h-full">
        {imageUrl && (
          <div className="mb-4 -mx-6 -mt-6 overflow-hidden rounded-t-card">
            <img
              src={imageUrl}
              alt={boat.nombre}
              className="w-full h-48 object-cover"
            />
          </div>
        )}
        <h3 className="text-lg font-medium text-gray-900 mb-2">
          {boat.nombre}
        </h3>
        {boat.capacidad_pasajeros && (
          <p className="text-sm text-gray-500 mb-2">
            Capacidad: {boat.capacidad_pasajeros} pasajeros
          </p>
        )}
        {boat.descripcion && (
          <p className="text-sm text-gray-600 line-clamp-3">
            {boat.descripcion}
          </p>
        )}
        <div className="mt-4 pt-4 border-t border-border">
          <span className="text-sm font-medium text-primary-500">
            Ver detalles →
          </span>
        </div>
      </Card>
    </Link>
  );
};

export default BoatCard;