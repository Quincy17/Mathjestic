import React from "react";

export function Card({ title, children }) {
  return (
    <div className="bg-white shadow rounded-lg p-4">
      <h3 className="text-lg font-semibold">{title}</h3>
      <div>{children}</div>
    </div>
  );
}
