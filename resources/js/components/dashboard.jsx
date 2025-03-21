import { Card } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { useState } from "react";

export default function AdminDashboard() {
  const [stats, setStats] = useState({
    totalSoal: 120,
    totalLogs: 250,
    totalUnduhan: 340,
  });

  return (
    <div className="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
      {/* Card Total Soal */}
      <Card>
        <CardHeader>
          <CardTitle>Total Soal</CardTitle>
        </CardHeader>
        <CardContent>
          <p className="text-2xl font-bold">{stats.totalSoal}</p>
          <Button className="mt-4 w-full" variant="outline">Kelola Soal</Button>
        </CardContent>
      </Card>

      {/* Card Total Logs */}
      <Card>
        <CardHeader>
          <CardTitle>Aktivitas</CardTitle>
        </CardHeader>
        <CardContent>
          <p className="text-2xl font-bold">{stats.totalLogs}</p>
          <Button className="mt-4 w-full" variant="outline">Lihat Log</Button>
        </CardContent>
      </Card>

      {/* Card Total Unduhan */}
      <Card>
        <CardHeader>
          <CardTitle>Total Unduhan</CardTitle>
        </CardHeader>
        <CardContent>
          <p className="text-2xl font-bold">{stats.totalUnduhan}</p>
          <Button className="mt-4 w-full" variant="outline">Lihat Detail</Button>
        </CardContent>
      </Card>
    </div>
  );
}
