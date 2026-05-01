import type { DepartureTime } from '../types';
import Card from './Card';

interface DepartureCardProps {
  departure: DepartureTime;
}

/**
 * DepartureCard component - displays departure with converted times
 */
const DepartureCard = ({ departure }: DepartureCardProps) => {
  const formatPrice = (price: number) => {
    return new Intl.NumberFormat('es-EC', {
      style: 'currency',
      currency: 'USD',
    }).format(price);
  };

  return (
    <Card className="mb-4">
      <div className="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        {/* Boat and Port Info */}
        <div className="flex-1">
          <h4 className="text-lg font-medium text-gray-900">
            {departure.barco}
          </h4>
          <p className="text-sm text-gray-500">
            Puerto: {departure.puerto}
          </p>
          <p className="text-lg font-medium text-primary-500 mt-2">
            {formatPrice(departure.precio)}
          </p>
        </div>

        {/* Galápagos Time */}
        <div className="flex-1 border-t lg:border-t-0 lg:border-l border-border pt-4 lg:pt-0 lg:pl-4">
          <p className="text-xs text-gray-500 uppercase tracking-wide mb-1">
            Hora Galápagos
          </p>
          <p className="text-sm font-medium text-gray-900">
            Salida: {departure.salida_galapagos}
          </p>
          <p className="text-sm font-medium text-gray-900">
            Retorno: {departure.retorno_galapagos}
          </p>
        </div>

        {/* Local Time */}
        <div className="flex-1 border-t lg:border-t-0 lg:border-l border-border pt-4 lg:pt-0 lg:pl-4">
          <p className="text-xs text-gray-500 uppercase tracking-wide mb-1">
            Tu Hora Local
          </p>
          <p className="text-sm font-medium text-gray-900">
            Salida: {departure.salida_local}
          </p>
          <p className="text-sm font-medium text-gray-900">
            Retorno: {departure.retorno_local}
          </p>
        </div>
      </div>
    </Card>
  );
};

export default DepartureCard;