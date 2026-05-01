import type { ReactNode } from 'react';

interface CardProps {
  children: ReactNode;
  header?: ReactNode;
  footer?: ReactNode;
  className?: string;
}

/**
 * Card component with slots for header, body, footer
 */
const Card = ({ children, header, footer, className = '' }: CardProps) => {
  return (
    <div className={`card ${className}`}>
      {header && (
        <div className="mb-4 border-b border-border pb-4">
          {header}
        </div>
      )}
      <div>{children}</div>
      {footer && (
        <div className="mt-4 pt-4 border-t border-border">
          {footer}
        </div>
      )}
    </div>
  );
};

export default Card;