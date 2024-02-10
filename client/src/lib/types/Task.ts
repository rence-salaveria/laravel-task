export type CreateTask = {
  taskName: string;
  taskDescription: string;
  taskPriority: TaskPriority;
  taskStatus: TaskStatus;
};

export type UpdateTask = {
  taskId: string;
  taskName?: string;
  taskDescription?: string;
  taskPriority?: TaskPriority;
  taskStatus?: TaskStatus;
};

export type Task = {
  taskId: string;
  taskName: string;
  taskDescription: string;
  taskPriority: TaskPriority;
  taskStatus: TaskStatus;
  createdAt: string;
  updatedAt: string;
};

export enum TaskPriority {
  LOW = 1,
  MEDIUM,
  HIGH,
  URGENT,
}

export enum TaskStatus {
  PENDING = 1,
  IN_PROGRESS,
  COMPLETED,
  CANCELLED,
}
